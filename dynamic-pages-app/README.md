# Dynamic Pages App

## Overview
The Dynamic Pages App is designed to create and manage dynamic web pages for a company. It includes various sections such as "About," "Advisory Board," "Privacy Policy," and "Contact Us," all organized under the "Company" section in both the dashboard and the website frontend.

## Project Structure
The project is organized into several directories and files:

- **src/**: Contains the source code for the application.
  - **pages/**: Contains the individual page components.
    - **company/**: Contains the company-related pages.
      - `about.ts`: Renders the "About" page content.
      - `advisory-board.ts`: Renders the "Advisory Board" page content.
      - `contact-us.ts`: Renders the "Contact Us" page content.
      - `privacy-policy.ts`: Renders the "Privacy Policy" page content.
    - `index.ts`: Serves as an aggregator for the pages or defines routes.
  - **components/**: Contains reusable components for the application.
    - **dashboard/**: Contains components related to the dashboard.
      - `company-section.ts`: Organizes and displays the company-related pages.
      - `sidebar.ts`: Contains the sidebar navigation component.
    - **layout/**: Contains layout components.
      - `header.ts`: Header component for the application layout.
      - `footer.ts`: Footer component for the application layout.
    - **ui/**: Contains UI components.
      - `page-renderer.ts`: Handles rendering of different pages dynamically.
      - `navigation.ts`: Contains navigation links for the application.
  - **models/**: Contains data models for the application.
    - `page.ts`: Defines the model for the pages.
  - **controllers/**: Contains the logic for handling requests.
    - `dashboard.ts`: Handles logic for the dashboard.
    - `pages.ts`: Handles logic for rendering dynamic pages.
  - **routes/**: Defines the routes for the application.
    - `dashboard.ts`: Routes for the dashboard.
    - `pages.ts`: Routes for the dynamic pages.
  - `app.ts`: Entry point of the application.

- **public/**: Contains static assets.
  - **css/**: Contains CSS styles.
    - `styles.css`: Styles for the application.
  - **js/**: Contains JavaScript files.
    - `main.js`: Client-side JavaScript functionality.

- **views/**: Contains EJS templates for rendering views.
  - **dashboard/**: Templates for the dashboard.
    - `company.ejs`: Template for the company section.
    - `index.ejs`: Template for the main dashboard view.
  - **pages/**: Templates for dynamic pages.
    - `dynamic-page.ejs`: Template for rendering dynamic pages.
  - `layout.ejs`: Layout template including header, footer, and main content area.

- **package.json**: Configuration file for npm, listing dependencies and scripts.

- **tsconfig.json**: TypeScript configuration file specifying compiler options.

## Getting Started
To get started with the Dynamic Pages App, clone the repository and install the dependencies:

```bash
npm install
```

Then, run the application:

```bash
npm start
```

Visit `http://localhost:3000` in your browser to view the application.

## Features
- Dynamic rendering of company-related pages.
- Organized dashboard with a sidebar for easy navigation.
- Responsive layout with header and footer components.

## Contributing
Contributions are welcome! Please submit a pull request or open an issue for any enhancements or bug fixes.

## License
This project is licensed under the MIT License.