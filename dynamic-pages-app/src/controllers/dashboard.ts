import { Request, Response } from 'express';
import { renderPage } from '../components/ui/page-renderer';

export const renderCompanySection = (req: Request, res: Response) => {
    const pages = [
        { title: 'About', path: '/company/about' },
        { title: 'Advisory Board', path: '/company/advisory-board' },
        { title: 'Contact Us', path: '/company/contact-us' },
        { title: 'Privacy Policy', path: '/company/privacy-policy' },
    ];

    res.render('dashboard/company', { pages });
};

export const renderDynamicPage = (req: Request, res: Response) => {
    const pageTitle = req.params.pageTitle;
    renderPage(pageTitle)
        .then(content => {
            res.render('pages/dynamic-page', { content });
        })
        .catch(err => {
            res.status(404).send('Page not found');
        });
};