export interface Page {
    title: string;
    content: string;
    metadata?: {
        description?: string;
        keywords?: string[];
        author?: string;
    };
}