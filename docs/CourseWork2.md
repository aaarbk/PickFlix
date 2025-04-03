## Detail of the task

Your application should present information for ONE particular online streaming service, this should be based on a real-world service (e.g. Netflix, Amazon Prime Video, etc.) that provides useful information about the streaming service system itself and a set of recommended movies/TV shows. You should also present additional content that is relevant to each movie/TV show, such as providing a personal recommendation score.

Your application is expected to provide content on at least THREE individual movies/TV shows available on the online streaming service. 

The specification for the application you are designing is detailed in the Application Requirements section later in this specification.

The additional content can consist of multimedia such as images, videos, text. You may use external embedded content and public web APIs such as YouTube, Google Maps, YQL, Flickr etc to help provide this content.

The specific features you are expected to implement as a MINIMUM are stated in the Application Requirements section, later in this document.

The PHP application will be using version 7+ of this language. The application is required to present the application front-end user interface to the user using a combination of HTML5, CSS3 and JavaScript. The PHP application will be hosted on the web server using the apache web root folder htdocs. The user-interface should be dynamically generated using PHP web development techniques.

The web application will be accessed via the Google Chrome web browser – this is the user’s Client. The client-side user interface should utilise the Bootstrap front-end framework (any version above v3.0) to render the HTML5 markup that comprises the content and structure of the site. The site should be styled using CSS3 and work with both Mobile and Desktop clients. You should also use Bootstrap-compatible JavaScript frameworks such as JQuery, Bootstrap.js, FontAwesome.js etc for the client-side behaviours of your application. You may also incorporate any other JavaScript frameworks that you deem useful to the development of your application.

You may use code and techniques from the module tutorials to assist you.

The software development toolkit required to develop this application is freely available, as explained in the first tutorial of this module. The toolkit is also available through a series of links on the Canvas page for the module.

You are expected to use Windows as your primary development platform, and is the ONLY supported platform for development. You will need to find your own Web Server setup if you wish to develop using other Operating Systems.

You are not allowed to use generative AI to do any part of this coursework.

## Application Requirements

You will be assessed on both the functionality of your site and appropriateness of the dynamic web application techniques used to implement this functionality.

### Application Pages

- The home page view should provide a summary view of at least THREE of the movies/TV Shows available on the site AND links to the description page (see below: streaming service overview page) of your chosen streaming service AND links to the individual page for each individual movie/TV Show (see below: individual movie/TV show view).
- An individual movie/TV Show view for each of the recommended movies/TV Shows which presents information on the movie/TV Show (e.g. name, director, cast, release date, age rating etc). This view also displays ALL the user contributed reviews associated with the movie/TV Show.
- A ranking view which presents a table of all the movies/TV Shows, with key information, including your review score and average user score.
- A streaming service overview page, which presents important information about your chosen streaming service.
- Each of the views/pages should be hyperlinked together with some form of master page/common layout containing content that is present across all pages of the application, such as a global navigation scheme – the layout of this navigation is up to you.

### Functional Requirements:

Your web application should provide the following functionality to the user:

- Provide a description, recommendation and supporting information on at least THREE MOVIES/TV SHOWS. They can be any movie/TV show that was been released before the hand-in deadline but it should be PG-13 or lower.
- Each movie/TV Show should have the FOLLOWING CONTENT with it:
  - An editorial recommendation (your own review) - this does not need to be more than a couple of paragraphs.
  - A recommendation score (out of 10) – the score you award is up to you – scores DO NOT need to be unique across the movies/TV Shows.
  - A key facts section which provides details about the Movie/TV Show (e.g., director, release date, cast, duration, age rating, genre, etc.). It is for you to determine the key facts.
  - Links to THREE OFFICIAL reviews from an external review source (e.g. a magazine review, newspaper review or movie/TV shows review site such as IMDB, Metacritic, etc).
  - The site should also support USER REVIEWS; these are reviews posted by users of the site. If there are no user reviews for a given movie/TV show, this should be made clear to the user. The site should not support anonymous reviews. This data should be gathered from logged in user (see profile system) stored in a JSON file.
  - The user reviews should provide a rating for the movie/TV show out of 10.
- The application should have a user profile system:
  - As a minimum, the user should have to specify their username and password to log in.
  - Users do not have to log in to view the content of the site, only to post reviews on movies/TV shows.
  - How the users post a review is up to you (could be a separate page or incorporated into one of the other required pages).
  - When logged in, the user’s name should be displayed. This should be present the whole time they are logged in, regardless of what part of the site they are on.
  - ADDITIONAL MARKS will be awarded for:
    - Storing information on the user (e-mail address, etc)
    - Profile Specific information (e.g. allowing them to pick a favourite movie/TV show from the list of movies/TV shows or showing reviews they have made).

- The application should have a ranking system, which displays all movies/TV shows as a table:
  - You will also be awarded marks based on how informative and concise the table is (e.g. your choice of columns) – as a minimum, it should include your Recommendation Score.
  - Higher marks for being able to sort this table of information based on these categories and their rating. Sorting is expected to be done server-side.
  - It is up to you how you determine the overall rating of a movie/TV show based on the reviews.

- The application should have a streaming service overview page, presenting useful information about your chosen streaming service.
  - This could be information about the streaming service, different subscription plans and prices, description of the service, availability of application for different platforms (e.g., mobile app, browser app, Smart TV app, etc.).
  - You can use content from other sites and multi-media sources to help present this information.
  - This page should be creatively presented and make use of different types of media (Text, Images, Videos, Web APIs etc).

You are also expected to produce ONE ADDITIONAL application view that is unique to your interpretation of this web application – what you choose to add to this view is up to you.

You should clearly identify this additional application view; its purpose and supported functionality in your source code. You must make it clear to the markers which page you consider your additional functionality.

You will be assessed on the technical quality of the view you produce in terms of its structure, style and behaviour. Your web application should conform to the following web development practices:

- The movies/TV shows recommendation data, user review data and user data should be dynamically generated each time the site is viewed. To accomplish this, you will need to store data in files on the server. The types of file are up to you, but common formats are plain text files, static HTML files, PNG/JPG images and JSON Files – YOU ARE NOT PERMITTED TO USE AN SQL DATABASE IN THIS MODULE.
- The views of application listed above should be split across multiple PHP pages to form your overall application.
- The individual views should be connected together using a combination of navigation, hyperlinking, query strings and cross-page form posting. Higher marks will be awarded for a site that is easy to navigate via the page content, without relying on the browser navigation controls.
- The application views of the pages should be rendered using HTML5 markup using the Twitter Bootstrap framework.
- The pages should be styled using a custom Bootstrap theme. The CSS should adhere to the Bootstrap conventions for IDs and classes. You may also use graphical elements such as images, glyphs and fonts to enhance the look of your application. The client-side technology (HTML/CSS/JavaScript) used for adding graphics is up to you.
- Elements of the site that are common to each page and the global navigation scheme should be placed in a master page, which all other pages utilise (the manner in which your pages utilise this master page is up to you).
- Your site layout should be responsive - not fixed to a particular resolution. Your site should be viewable using Google Chrome browser on desktop/laptop PCs, tablets and smartphones.
- You should adopt the Mobile-First, Progressive Enhancement paradigm to develop your website.
- You should apply client-side technologies to enhance your site from both a usability and aesthetic perspective. Examples include: input data validation, animated elements, popups and modal dialogs, transitions etc.
- Your user profile and user review data that is transmitted from the client to the server is expected to be validated server-side; you should not rely on client-side validation alone.

You may use multimedia assets from external resources to help produce the required content of your web application.

## Marking Scheme/Assessment Criteria

| **Assessment Criteria**                                      | **% of Weight** |
| ------------------------------------------------------------ | --------------- |
| **Application Functionality**                                | **55**          |
| Implementation of Home Page (and Summaries)                  | 5               |
| Implementation of the Streaming Service Overview             | 5               |
| Implementation of the Movie/TV Show Recommendation and User Review Display | 15              |
| Implementation of the Ranking View                           | 10              |
| Implementation of the User Profile System                    | 7               |
| Implementation of the Submission of User Reviews             | 8               |
| Implementation of the Additional Unique Application View     | 5               |
| **Web Development Techniques**                               | **45**          |
| PHP Request, Application Page Logic and Response Generation to Dynamically Generate Pages | 10              |
| Representation of Common Elements (Master Page) and Global Navigation | 10              |
| Application Theme and Responsive Layout                      | 5               |
| Server-Side Representation of Application Data and use of Data Files | 10              |
| Client-Side Scripting                                        | 5               |
| Application Structure, Use of Hyperlinks/UI Controls to Connect Pages | 5               |
| **TOTAL**                                                    | **100**         |
