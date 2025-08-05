# Company Pages App

This project is a web application that provides dynamic pages for company-related information. It includes sections for the Advisory Board, Privacy Policy, About, and Contact Us, all organized under the Company section in the frontend dashboard and website.

## Project Structure

The project is structured as follows:

```
company-pages-app
├── src
│   ├── components
│   │   ├── Layout
│   │   │   ├── Header.tsx        # Header component with navigation links
│   │   │   ├── Footer.tsx        # Footer component
│   │   │   └── Sidebar.tsx       # Sidebar component for dashboard navigation
│   │   ├── Company
│   │   │   ├── AdvisoryBoard.tsx  # Component for Advisory Board page
│   │   │   ├── PrivacyPolicy.tsx  # Component for Privacy Policy page
│   │   │   ├── About.tsx          # Component for About page
│   │   │   └── ContactUs.tsx      # Component for Contact Us page
│   │   └── Dashboard
│   │       ├── CompanySection.tsx  # Component to display company-related pages
│   │       └── PageEditor.tsx      # Component for editing company pages
│   ├── pages
│   │   ├── company
│   │   │   ├── advisory-board.tsx   # Page for Advisory Board
│   │   │   ├── privacy-policy.tsx   # Page for Privacy Policy
│   │   │   ├── about.tsx            # Page for About
│   │   │   └── contact-us.tsx       # Page for Contact Us
│   │   ├── dashboard
│   │   │   └── company.tsx          # Dashboard page for company section
│   │   └── index.tsx                 # Main entry point of the application
│   ├── hooks
│   │   └── useCompanyPages.ts        # Custom hook for managing company pages
│   ├── types
│   │   └── index.ts                  # Types and interfaces used in the application
│   └── app.tsx                       # Main application component
├── package.json                      # npm configuration file
├── tsconfig.json                     # TypeScript configuration file
└── README.md                         # Project documentation
```

## Features

- **Dynamic Pages**: The application includes dynamic pages for the Advisory Board, Privacy Policy, About, and Contact Us.
- **Company Section**: All company-related pages are organized under a dedicated section in the dashboard.
- **Responsive Layout**: The layout components ensure a responsive design for various screen sizes.

## Getting Started

To get started with the project, clone the repository and install the dependencies:

```bash
git clone <repository-url>
cd company-pages-app
npm install
```

Then, you can run the application:

```bash
npm start
```

## Contributing

Contributions are welcome! Please open an issue or submit a pull request for any enhancements or bug fixes.

## License

This project is licensed under the MIT License.