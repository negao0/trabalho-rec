import express from 'express';
import { db } from '../database.js';

const router = express.Router();

router.get('/', (req, res) => {
  const query = `
    SELECT p.*, c.name as category_name 
    FROM products p 
    JOIN categories c ON p.category_id = c.id
  `;
  
  db.all(query, [], (err, products) => {
    db.all('SELECT * FROM categories', [], (err, categories) => {
      res.render('products', { products, categories });
    });
  });
});

router.post('/', (req, res) => {
  const { category_id, name, description } = req.body;
  db.run('INSERT INTO products (category_id, name, description) VALUES (?, ?, ?)',
    [category_id, name, description],
    (err) => {
      res.redirect('/products');
    });
});

export default router;