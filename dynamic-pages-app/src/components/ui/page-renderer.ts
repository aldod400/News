import React from 'react';
import About from '../../pages/company/about';
import AdvisoryBoard from '../../pages/company/advisory-board';
import ContactUs from '../../pages/company/contact-us';
import PrivacyPolicy from '../../pages/company/privacy-policy';

const pageComponents = {
    about: About,
    advisoryBoard: AdvisoryBoard,
    contactUs: ContactUs,
    privacyPolicy: PrivacyPolicy,
};

const PageRenderer = ({ pageKey }) => {
    const PageComponent = pageComponents[pageKey];

    if (!PageComponent) {
        return <div>Page not found</div>;
    }

    return <PageComponent />;
};

export default PageRenderer;