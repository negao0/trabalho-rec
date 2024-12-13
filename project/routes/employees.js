import express from 'express';
import { db } from '../database.js';

const router = express.Router();

router.get('/', (req, res) => {
  db.all('SELECT * FROM employees', [], (err, employees) => {
    res.render('employees', { employees });
  });
});

router.post('/', (req, res) => {
  const { name, phone } = req.body;
  db.run('INSERT INTO employees (name, phone) VALUES (?, ?)',
    [name, phone],
    (err) => {
      res.redirect('/employees');
    });
});

export default router;