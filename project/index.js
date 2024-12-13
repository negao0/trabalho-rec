import express from 'express';
import bodyParser from 'body-parser';
import { fileURLToPath } from 'url';
import { dirname, join } from 'path';

import categoriesRouter from './routes/categories.js';
import donorsRouter from './routes/donors.js';
import employeesRouter from './routes/employees.js';
import productsRouter from './routes/products.js';
import donationsRouter from './routes/donations.js';

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

const app = express();
const port = 3000;

// Middleware
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static('public'));
app.set('view engine', 'ejs');
app.set('views', join(__dirname, 'views'));

// Routes
app.get('/', (req, res) => {
  res.render('index');
});

app.use('/categories', categoriesRouter);
app.use('/donors', donorsRouter);
app.use('/employees', employeesRouter);
app.use('/products', productsRouter);
app.use('/donations', donationsRouter);

// Start server
app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});