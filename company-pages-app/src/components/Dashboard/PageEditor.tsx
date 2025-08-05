import React from 'react';
import { useCompanyPages } from '../../hooks/useCompanyPages';

const PageEditor: React.FC = () => {
    const { pages, updatePageContent } = useCompanyPages();

    const handleContentChange = (pageId: string, newContent: string) => {
        updatePageContent(pageId, newContent);
    };

    return (
        <div>
            <h1>Edit Company Pages</h1>
            {pages.map(page => (
                <div key={page.id}>
                    <h2>{page.title}</h2>
                    <textarea
                        value={page.content}
                        onChange={(e) => handleContentChange(page.id, e.target.value)}
                    />
                </div>
            ))}
        </div>
    );
};

export default PageEditor;