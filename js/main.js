$(function () {
  var typingPhrases = [
    "Viljamas S.",
    "a Front-End Developer",
    "ready to build your next project"
  ];
  var typingElement = $("#typing-banner");
  var phraseIndex = 0;
  var characterIndex = 0;
  var isDeleting = false;

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

  var menuToggle = $(".menu-toggle");
  var pageMenu = $(".pages");

  menuToggle.on("click", function () {
    var isOpen = pageMenu.hasClass("open");
    pageMenu.toggleClass("open");
    $(this).attr("aria-expanded", String(!isOpen));
  });

  pageMenu.find("a").on("click", function () {
    if (window.innerWidth < 768) {
      pageMenu.removeClass("open");
      menuToggle.attr("aria-expanded", "false");
    }
  });

  $(window).on("resize", function () {
    if (window.innerWidth >= 768) {
      pageMenu.removeClass("open");
      menuToggle.attr("aria-expanded", "false");
    }
  });

  var contactForm = $("#contact-form");
  var statusMessage = $("#form-status");
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
  var phoneRegex = /^(\+?\d{1,3}[\s-]?)?(\(?\d{3}\)?[\s-]?)?\d{3}[\s-]?\d{4}$/;

  function setFieldError(field, hasError) {
    field.toggleClass("input-error", hasError);
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

    if (errors.length) {
      statusMessage.removeClass("success").addClass("error");
      statusMessage.text("Please fix: " + errors.join(", "));
      return;
    }

    statusMessage.removeClass("error").addClass("success");
    statusMessage.text("Thanks! Your message has passed validation and is ready to send.");
    contactForm[0].reset();
  });

  contactForm.find("input").on("input", function () {
    $(this).removeClass("input-error");
    if (statusMessage.hasClass("error")) {
      statusMessage.text("");
    }
  });

  $(".phone-number").on("click", function () {
    navigator.clipboard.writeText($(this).text().trim()).then(function () {
      statusMessage.removeClass("error").addClass("success");
      statusMessage.text("Phone number copied to clipboard.");
    }).catch(function () {
      // Clipboard API can fail on insecure origins, so silently ignore.
    });
  });
});
