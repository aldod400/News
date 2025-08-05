export interface CompanyPage {
    title: string;
    content: string;
    slug: string;
}

export type CompanyPages = {
    advisoryBoard: CompanyPage;
    privacyPolicy: CompanyPage;
    about: CompanyPage;
    contactUs: CompanyPage;
};