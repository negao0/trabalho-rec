import express from 'express';
import { db } from '../database.js';

const router = express.Router();

router.get('/', (req, res) => {
  db.all('SELECT * FROM donors', [], (err, donors) => {
    res.render('donors', { donors });
  });
});

router.post('/', (req, res) => {
  const { name, email, cpf } = req.body;
  db.run('INSERT INTO donors (name, email, cpf) VALUES (?, ?, ?)',
    [name, email, cpf],
    (err) => {
      res.redirect('/donors');
    });
});

export default router;