import { Request, Response } from 'express';
import { renderPage } from '../components/ui/page-renderer';

export const renderAboutPage = (req: Request, res: Response) => {
    const pageContent = {
        title: 'About Us',
        content: 'This is the About Us page content.',
    };
    renderPage(res, pageContent);
};

export const renderAdvisoryBoardPage = (req: Request, res: Response) => {
    const pageContent = {
        title: 'Advisory Board',
        content: 'This is the Advisory Board page content.',
    };
    renderPage(res, pageContent);
};

export const renderPrivacyPolicyPage = (req: Request, res: Response) => {
    const pageContent = {
        title: 'Privacy Policy',
        content: 'This is the Privacy Policy page content.',
    };
    renderPage(res, pageContent);
};

export const renderContactUsPage = (req: Request, res: Response) => {
    const pageContent = {
        title: 'Contact Us',
        content: 'This is the Contact Us page content.',
    };
    renderPage(res, pageContent);
};