import { useState } from 'react';

const useCompanyPages = () => {
    const [pages, setPages] = useState({
        advisoryBoard: {
            title: 'Advisory Board',
            content: 'Content for the Advisory Board page.',
        },
        privacyPolicy: {
            title: 'Privacy Policy',
            content: 'Content for the Privacy Policy page.',
        },
        about: {
            title: 'About',
            content: 'Content for the About page.',
        },
        contactUs: {
            title: 'Contact Us',
            content: 'Content for the Contact Us page.',
        },
    });

    const updatePageContent = (pageKey, newContent) => {
        setPages((prevPages) => ({
            ...prevPages,
            [pageKey]: {
                ...prevPages[pageKey],
                content: newContent,
            },
        }));
    };

    return {
        pages,
        updatePageContent,
    };
};

export default useCompanyPages;