import $ from 'jquery';

class Search {
  constructor() {
    this.openButton = $('#main-search-button');
    this.closeButton = $('.search-overlay__close');
    this.searchOverlay = $('.search-overlay');
    this.resultsContainer = $('#search-overlay__results');
    this.searchInput = $('#search-term');
    this.previousSearchTerm = null;
    this.isSpinnerVisible = false;
    this.isOverlayOpen = false;
    this.typingTimer = null;
    this.events();
  }

  events = () => {
    let user_agent_os = 'Windows';

    if (window.navigator.userAgent.indexOf('Mac') !== -1) {
      user_agent_os = 'MacOS';
    }

    $('body').attr('data-os', user_agent_os);
    $(document).on('keydown', this.keyPressDispatcher);

    this.openButton.on('click', this.openOverlay);
    this.closeButton.on('click', this.closeOverlay);
    this.searchInput.on('keyup', this.typingLogic);
  };

  typingLogic = () => {
    if (this.previousSearchTerm !== this.searchInput.val()) {
      clearTimeout(this.typingTimer);

      if (this.searchInput.val()) {
        if (!this.isSpinnerVisible) {
          this.resultsContainer.html('<div class="spinner-loader"></div>');
          this.isSpinnerVisible = true;
        }

        this.typingTimer = setTimeout(this.getResults, 500);
      } else {
        this.resultsContainer.html('');
        this.isSpinnerVisible = false;
      }

      this.previousSearchTerm = this.searchInput.val();
    }
  };

  getResults = async () => {
    try {
      const response = await fetch(
        `${brandit_data.root_url}/wp-json/brandit/v1/search?q=${this.searchInput.val()}`
      );

      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }

      const results = await response.json();

      const row = $('<div class="row"></div>');

      this.resultsContainer.html(row);

      row.append(this.generateGeneralInfoSection(results?.general_info));
      row.append(this.generateServicesSection(results?.services));
      row.append(this.generateEventsSection(results?.events));
    } catch (error) {
      console.error('Error fetching search results:', error);
    }
  };

  keyPressDispatcher = (e) => {
    // Check if CTRL (Windows/Linux) or CMD (macOS) is pressed
    const isModifierKey = e.ctrlKey || e.metaKey;
    // Detects the keyboard shortcut of CMD + K / CTRL + K
    const isKeyboardShortcutKey = isModifierKey && e.key?.toLowerCase() === 'k';

    if (isKeyboardShortcutKey && !this.isOverlayOpen) {
      this.openOverlay();
    }

    if (e.key === 'Escape' && this.isOverlayOpen) {
      this.closeOverlay();
    }
  };

  openOverlay = () => {
    $('body').addClass('body-no-scroll');
    this.searchOverlay.addClass('search-overlay--active');
    this.isOverlayOpen = true;
    this.searchInput.val('');
    setTimeout(() => this.searchInput.focus(), 315);
  };

  closeOverlay = () => {
    this.searchOverlay.removeClass('search-overlay--active');
    $('body').removeClass('body-no-scroll');
    this.isOverlayOpen = false;
  };

  generateGeneralInfoSection = (generalInfo) => {
    const sectionTitle = $(
      `<h2 class="search-overlay__section-title"></h2>`
    ).text('General Information');

    const generalInfoSection = $(
      `<div class="col-12 col-md-6 col-lg-4"></div>`
    );

    let content;

    if (generalInfo && generalInfo.length > 0) {
      content = $(`<ul class="list-unstyled"></ul>`);

      const resultsList = generalInfo.map((result) => {
        const listItem = $(`<li class="my-3"></li>`);
        const link = $(`<a class="h5"></a>`)
          .attr('href', result.permalink)
          .text(result.title);
        const byAuthor = result.author_name ? ` by ${result.author_name}` : '';

        listItem.append(link);
        listItem.append(byAuthor);

        return listItem;
      });

      content.append(resultsList);
    } else {
      const seeMoreLink = $(`<a>See our Blog</a>`).attr(
        'href',
        `${brandit_data.root_url}/blog`
      );
      content = $(`<p></p>`)
        .text('Nothing matches that search. ')
        .append(seeMoreLink);
    }

    generalInfoSection.append(sectionTitle);
    generalInfoSection.append(content);

    return generalInfoSection;
  };

  generateServicesSection = (services) => {
    const sectionTitle = $(
      `<h2 class="search-overlay__section-title"></h2>`
    ).text('Services');

    const servicesSection = $(`<div class="col-12 col-md-6 col-lg-4"></div>`);

    let content;

    if (services && services.length > 0) {
      content = $(`<ul class="list-unstyled"></ul>`);

      services.forEach((service) => {
        const listItem = $(`<li class="my-3"></li>`);
        const link = $(`<a class="h5"></a>`)
          .attr('href', service?.permalink)
          .text(service?.title);

        listItem.append(link);
        content.append(listItem);
      });
    } else {
      const seeMoreLink = $(`<a>See all Services</a>`).attr(
        'href',
        `${brandit_data.root_url}/services`
      );
      content = $(`<p></p>`)
        .text('No services match that search. ')
        .append(seeMoreLink);
    }

    servicesSection.append(sectionTitle);
    servicesSection.append(content);

    return servicesSection;
  };

  generateEventsSection = (events) => {
    const sectionTitle = $(
      `<h2 class="search-overlay__section-title"></h2>`
    ).text('Events');

    const eventsSection = $(`<div class="col-12 col-md-6 col-lg-4"></div>`);

    let content;

    if (events && events.length > 0) {
      content = $(`<div></div>`);

      events.forEach((event) => {
        const eventSummary = $(`<div class="event-summary"></div>`);

        const dateLink = $(
          `<a class="event-summary__date event-summary__date text-center"></a>`
        ).attr('href', event?.permalink);

        const monthElement = $(`<span class="date-summary-month"></span>`).text(
          event?.month
        );

        const dayElement = $(`<span class="date-summary-day"></span>`).text(
          event?.day
        );

        dateLink.append(monthElement, dayElement);

        const contentContainer = $(
          `<div class="event-summary__content"></div>`
        );

        const titleLink = $('<a></a>')
          .attr('href', event?.permalink)
          .text(event?.title);

        const title = $(
          `<h5 class="event-summary__title headline headline--tiny"></h5>`
        ).append(titleLink);

        const description = $(`<p></p>`).text(event?.description);

        contentContainer.append(title, description);
        eventSummary.append(dateLink, contentContainer);
        content.append(eventSummary);
      });
    } else {
      const seeMoreLink = $(`<a>See all Events</a>`).attr(
        'href',
        `${brandit_data.root_url}/events`
      );
      content = $(`<p></p>`)
        .text('No events match that search. ')
        .append(seeMoreLink);
    }

    eventsSection.append(sectionTitle);
    eventsSection.append(content);

    return eventsSection;
  };
}

export default Search;
