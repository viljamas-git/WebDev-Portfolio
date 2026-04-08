$(function () {
  // Rotating phrases rendered in the hero banner typing animation.
  var typingPhrases = [
    "Viljamas S.",
  ];
  var typingElement = $("#typing-banner");
  var phraseIndex = 0;
  var characterIndex = 0;
  var isDeleting = false;

  // Types and deletes characters to create a looping "typewriter" effect.
  function runTypingEffect() {
    if (!typingElement.length) {
      return;
    }

    var currentPhrase = typingPhrases[phraseIndex];
    var visibleText = currentPhrase.substring(0, characterIndex);
    typingElement.text(visibleText);

    if (!isDeleting && characterIndex < currentPhrase.length) {
      characterIndex += 1;
      setTimeout(runTypingEffect, 120);
      return;
    }

    if (!isDeleting && characterIndex === currentPhrase.length) {
      isDeleting = true;
      setTimeout(runTypingEffect, 1200);
      return;
    }

    if (isDeleting && characterIndex > 0) {
      characterIndex -= 1;
      setTimeout(runTypingEffect, 70);
      return;
    }

    isDeleting = false;
    phraseIndex = (phraseIndex + 1) % typingPhrases.length;
    setTimeout(runTypingEffect, 250);
  }

  runTypingEffect();

  // Mobile navigation controls.
  var menuToggle = $(".menu-toggle");
  var pageMenu = $(".pages");

  // Centralized helper that keeps menu CSS classes and ARIA state in sync.
  function setMenuState(isOpen) {
    pageMenu.toggleClass("open", isOpen);
    menuToggle.attr("aria-expanded", String(isOpen));
    $("body").toggleClass("menu-open", isOpen && window.innerWidth < 768);
  }

  menuToggle.on("click", function () {
    setMenuState(!pageMenu.hasClass("open"));
  });

  pageMenu.find("a").on("click", function () {
    if (window.innerWidth < 768) {
      setMenuState(false);
    }
  });

  $(document).on("click", function (event) {
    if (window.innerWidth >= 768 || !pageMenu.hasClass("open")) {
      return;
    }

    if (!$(event.target).closest(".pages, .menu-toggle").length) {
      setMenuState(false);
    }
  });

  $(document).on("keydown", function (event) {
    if (event.key === "Escape" && pageMenu.hasClass("open")) {
      setMenuState(false);
    }
  });

  $(window).on("resize", function () {
    if (window.innerWidth >= 768) {
      setMenuState(false);
    }
  });

  // Contact form state and validation patterns.
  var contactForm = $("#contact-form");
  var statusMessage = $("#form-status");
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
  var phoneRegex = /^(\+?\d{1,3}[\s-]?)?(\(?\d{3}\)?[\s-]?)?\d{3}[\s-]?\d{4}$/;

  // Adds/removes visual error styling for a form control.
  function setFieldError(field, hasError) {
    field.toggleClass("input-error", hasError);
  }

  // Normalizes server-side error formats into a plain list of messages.
  function collectErrorMessages(response) {
    if (!response) {
      return [];
    }

    if (Array.isArray(response.errors)) {
      return response.errors;
    }

    if (response.fieldErrors && typeof response.fieldErrors === "object") {
      return Object.keys(response.fieldErrors).map(function (fieldName) {
        return response.fieldErrors[fieldName];
      });
    }

    return [];
  }

  contactForm.on("submit", function (event) {
    event.preventDefault();

    var firstName = $("#first-name");
    var lastName = $("#last-name");
    var email = $("#email");
    var phone = $("#phone");
    var message = $("#message");
    var fields = [firstName, lastName, email, phone, message];
    var errors = [];

    // Client-side required field validation.
    fields.forEach(function (field) {
      setFieldError(field, false);
      if (!field.val().trim()) {
        setFieldError(field, true);
        errors.push(field.attr("name") + " is required");
      }
    });

    if (email.val().trim() && !emailRegex.test(email.val().trim())) {
      setFieldError(email, true);
      errors.push("Email format is invalid");
    }

    if (phone.val().trim() && !phoneRegex.test(phone.val().trim())) {
      setFieldError(phone, true);
      errors.push("Phone number format is invalid");
    }

    // Stop early if local validation fails to avoid unnecessary network calls.
    if (errors.length) {
      statusMessage.removeClass("success").addClass("error");
      statusMessage.text("Please fix: " + errors.join(", "));
      return;
    }

    // Submit asynchronously and display response feedback in-place.
    statusMessage.removeClass("error success").text("Sending...");

    $.ajax({
      url: contactForm.attr("action"),
      method: "POST",
      dataType: "json",
      data: contactForm.serialize()
    }).done(function (response) {
      if (response.success) {
        statusMessage.removeClass("error").addClass("success");
        statusMessage.text(response.message || "Thanks! Your message has been sent.");
        contactForm[0].reset();
        return;
      }

      statusMessage.removeClass("success").addClass("error");

      var responseErrors = collectErrorMessages(response);
      if (responseErrors.length) {
        statusMessage.text("Please fix: " + responseErrors.join(", "));
      } else {
        statusMessage.text(response.message || "Please review the highlighted fields.");
      }

      if (response.fieldErrors) {
        Object.keys(response.fieldErrors).forEach(function (fieldName) {
          var input = contactForm.find('[name="' + fieldName + '"]');
          setFieldError(input, true);
        });
      }
    }).fail(function (xhr) {
      var response = xhr.responseJSON || {};
      statusMessage.removeClass("success").addClass("error");

      var responseErrors = collectErrorMessages(response);
      if (responseErrors.length) {
        statusMessage.text("Please fix: " + responseErrors.join(", "));
        if (response.fieldErrors) {
          Object.keys(response.fieldErrors).forEach(function (fieldName) {
            var input = contactForm.find('[name="' + fieldName + '"]');
            setFieldError(input, true);
          });
        }
        return;
      }

      statusMessage.text(response.message || "Something went wrong sending your message. Please try again.");
    });
  });

  // Clear stale validation status as the user edits text inputs.
  contactForm.find("input").on("input", function () {
    $(this).removeClass("input-error");
    if (statusMessage.hasClass("error")) {
      statusMessage.text("");
    }
  });

  // Convenience action to copy displayed phone number to clipboard.
  $(".phone-number").on("click", function () {
    navigator.clipboard.writeText($(this).text().trim()).then(function () {
      statusMessage.removeClass("error").addClass("success");
      statusMessage.text("Phone number copied to clipboard.");
    }).catch(function () {
      // Clipboard API can fail on insecure origins, so silently ignore.
    });
  });
});
