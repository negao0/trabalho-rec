import express from 'express';
import { db } from '../database.js';

const router = express.Router();

router.get('/', (req, res) => {
  const query = `
    SELECT 
      d.id,
      dr.name as donor_name,
      p.name as product_name,
      e.name as employee_name,
      d.quantity,
      d.donation_date
    FROM donations d
    JOIN donors dr ON d.donor_id = dr.id
    JOIN products p ON d.product_id = p.id
    JOIN employees e ON d.employee_id = e.id
  `;
  
  db.all(query, [], (err, donations) => {
    db.all('SELECT * FROM donors', [], (err, donors) => {
      db.all('SELECT * FROM products', [], (err, products) => {
        db.all('SELECT * FROM employees', [], (err, employees) => {
          res.render('donations', { 
            donations, 
            donors, 
            products, 
            employees 
          });
        });
      });
    });
  });
});

router.post('/', (req, res) => {
  const { donor_id, product_id, employee_id, quantity } = req.body;
  const donation_date = new Date().toISOString().split('T')[0];
  
  db.run(`
    INSERT INTO donations (donor_id, product_id, employee_id, quantity, donation_date) 
    VALUES (?, ?, ?, ?, ?)`,
    [donor_id, product_id, employee_id, quantity, donation_date],
    (err) => {
      res.redirect('/donations');
    });
});

export default router;