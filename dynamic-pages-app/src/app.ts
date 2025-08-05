import express from 'express';
import bodyParser from 'body-parser';
import { dashboardRoutes } from './routes/dashboard';
import { pagesRoutes } from './routes/pages';

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));
app.set('view engine', 'ejs');
app.set('views', './views');

// Routes
app.use('/dashboard', dashboardRoutes);
app.use('/pages', pagesRoutes);

// Start the server
app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});