import express from 'express';
import { db } from '../database.js';

const router = express.Router();

router.get('/', (req, res) => {
  db.all('SELECT * FROM categories', [], (err, categories) => {
    res.render('categories', { categories });
  });
});

router.post('/', (req, res) => {
  const { name, description, observation } = req.body;
  db.run('INSERT INTO categories (name, description, observation) VALUES (?, ?, ?)',
    [name, description, observation],
    (err) => {
      res.redirect('/categories');
    });
});

export default router;