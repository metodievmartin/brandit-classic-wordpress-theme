# BrandIt Classic WordPress Theme

## Table of Contents

1. [Introduction](#1-introduction)
2. [Key Features](#2-key-features)
3. [Installation Instructions](#3-installation-instructions)
    - [Development & Build Process](#development--build-process)
4. [Theme Structure](#4-theme-structure)
    - [Custom Post Types & Taxonomies](#custom-post-types--taxonomies)
    - [Custom Fields & Metaboxes](#custom-fields--metaboxes)
    - [Custom Queries & Templates](#custom-queries--templates)
5. [Custom Plugins Overview](#5-custom-plugins-overview)
    - [BrandIt Business Information Plugin](#brandit-business-information-plugin)
    - [BrandIt Custom Functionality Plugin](#brandit-custom-functionality-plugin)
6. [REST API Endpoints](#6-rest-api-endpoints)
    - [Custom Search Endpoint](#custom-search-endpoint)
    - [Contact Form Submission Endpoint](#contact-form-submission-endpoint)
7. [Frontend Features](#7-frontend-features)
8. [Multilingual Support](#8-multilingual-support)
9. [Technical Info](#9-technical-info)

## 1. Introduction

**BrandIt Classic WordPress Theme** is a custom-built WordPress theme featuring integrated service and event management,
custom REST API endpoints, live search, dynamic content sections, blog, and business contact management.
These features make it ideal for businesses that offer services and occasionally run different events.

It comes bundled with two custom plugins - BrandIt Contact Info and BrandIt Custom Functionality.
These plugins provide the additional custom functionality like custom post types, REST API endpoints, dynamic templates,
and admin management tools. The theme uses a build process for the styles and the scripts with `wp-scripts` and
integrates Bootstrap for responsive design. Supports multilingual translation through WordPress i18n functions.

Key features include:

- **Custom Post Types:** Services, Events, and Form Submissions
- **Dynamic Content Section:** Custom queries for homepage sections, archives, and filters
- **REST API Endpoints:** Live search and AJAX contact form submissions
- **Admin Management Tools:** Business contact settings, post-type-specific options
- **Translation Ready:** WordPress i18n functions used everywhere

### Live Demo:

https://marmet21.dreamhosters.com/

## 2. Features Overview

- **Content Types:** Services, Events, Form Submissions
- **Relationships:** Link events to services via the admin dashboard
- **REST Endpoints:** Custom Endpoints providing Live Search API and contact form submission API
- **Menus:** Header menu and two footer menus
- **Admin Tools:** Custom settings for services and business information
- **Custom Queries:** Dynamically display services, events, and posts on the homepage
- **Bootstrap Integration:** Mobile-friendly and responsive
- **Multilingual Support:** Translation-ready with WordPress i18n functions

## 3. Installation Instructions

1. **Upload Theme:** Upload the theme folder to `/wp-content/themes/` or install via WordPress Admin.
2. **Activate Theme:** Go to WordPress Admin > Appearance > Themes and activate **BrandIt Classic WordPress Theme** or
   its child theme.
3. **Activate Plugins:** Ensure that **BrandIt Business Information** and **BrandIt Custom Functionality** plugins are
   activated (bundled with the theme).

### Development & Build Process

The source code files are located in `/wp-content/themes/brandit/client` folder
and the bundled files are output into `/wp-content/themes/brandit/public`

1. Navigate to theme root `/wp-content/themes/brandit`
2. Run `npm i` to install dependencies (if not installed already)
3. Run `npm start` to launch the development server and automatically rebuild the project whenever any change is
   detected.

**NOTE:** When ready to deploy the project, use the `npm run build` command. This optimises the code and makes it
production-ready.

## 4. Theme Structure

### Custom Post Types & Taxonomies

1. **Services (CPT):**
    - **Taxonomy:** Service Categories (hierarchical)
    - **Meta-Fields:** Service Icon Image via ACF

2. **Events (CPT):**
    - **Relationships:** Link events to services using ACF
    - **Custom Fields:** Event Date, Related Service using ACF | Event Location (Address & URL) via custom metabox

3. **Form Submissions (CPT):**
    - **Purpose:** Stores submitted contact forms. Holds information about the sender's name, email, subject, message
      and the date

### Custom Fields & Metaboxes

- **Hero Banner:** Custom title, subtitle, and image uploader with pre-defined image size `hero-banner-portrait`.
- **About Us Section:** Custom title, subtitle, and two image uploader with pre-defined image size
  `hero-banner-portrait`.
- **Services Settings:** Admin option for limiting services displayed.
- **Contact Information Fields:** Managed via the BrandIt Business Information plugin.

### Custom Queries & Templates

- **Homepage Sections:**
    - Latest Services (dynamic)
    - Closest Upcoming Events (custom query)
    - Latest Blog Posts (custom query)

- **Archive Pages:**
    - **Services Archive:** Paginated, filterable by service categories.
    - **Events Archive:** Lists upcoming events by event date.
    - **Blog Archive:** Dedicated category, author, and date pages.

## 5. Custom Plugins Overview

### **BrandIt Business Information Plugin**

- **Stored as Options in the DB:**
    - Business Contact Email: `bci_contact_email_address`
    - Business Contact Phone: `bci_contact_phone_number`
    - Business Contact Address: `bci_contact_address`

- **Admin Settings Page:** Allows entering business contact details visible on the contact page.

### **BrandIt Custom Functionality Plugin**

- **Custom Post Types Registered:** Services, Events, Form Submissions
- **Shortcode:**

  ```php
  [upcoming_events_list posts_per_page="3"]
  ```

    - **Purpose:** Lists upcoming events with a default template that can be overridden.
    - **Arguments:** `posts_per_page` (number of events to display)
    - **Template Override Locations:**
        - `template-parts/upcoming-events-listing.php`
        - `template-parts/events/upcoming-events-listing.php`
        - `partials/upcoming-events-listing.php`
        - `partials/events/upcoming-events-listing.php`


- **Custom Admin Settings:** Service display limit field available in the Services admin section.

## 6. REST API Endpoints

### **Custom Search Endpoint**

- **Route:** `GET /wp-json/brandit/v1/search?q=`
- **Description:** Returns pages, posts, services, and events matching the search term `q`. Accounting for the relations
  between Events and Services.

### **Contact Form Submission Endpoint**

- **Route:** `POST /wp-json/brandit/v1/submit-form`
- **Required Fields:**
    - `sender_name` (string)
    - `sender_email` (string)
    - `message` (string)
    - `nonce` (security token)

- **Validation:** Client-side and server-side validation, Bootstrap form validation. reCAPTCHA integration planned.

## 7. Frontend Features

- **Homepage:** Custom sections for hero banner, latest services, upcoming events, and latest blog posts.
- **About Us Page:** Section with custom titles, images and content.
- **Services Archive:** Paginated, filterable by service categories.
- **Events Archive:** Sorted by event date meta-field, showing only upcoming events.
- **Blogs Archive** A template dedicated to category, author and date as well.
- **Contact Page:** Displays contact info from BrandIt Business Information and a working AJAX contact form.

## 8. Multilingual Support

- **Translation Ready:** All strings passed through i18n functions

## 9. Technical Info

- **WordPress Version:** 6.7.1
- **PHP Version:** 8.3
- **Additional Dependencies:**
    - Bootstrap: 5.3.3
    - @wordpress/scripts: 30.5.1
    - prettier: 3.3.3
