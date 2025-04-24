import { useState, useEffect } from 'react';
import axios from './axios';
import './styles/Student.css';

export default function StudentForm({ fetchStudents, editingStudent, setEditingStudent }) {
  const [form, setForm] = useState({
    name: '',
    email: '',
    age: '',
    major: ''
  });
  const [errors, setErrors] = useState({});
  const [successMessage, setSuccessMessage] = useState(''); 

  useEffect(() => {
    if (editingStudent) {
      setForm(editingStudent);
      setErrors({});
    }
  }, [editingStudent]);

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      if (editingStudent) {
        await axios.put(`/students/${editingStudent.id}`, form);
        setSuccessMessage('Student updated successfully!');
      } else {
        await axios.post('/students', form);
        setSuccessMessage('Student added successfully!');
      }

      setForm({ name: '', email: '', age: '', major: '' });
      setEditingStudent(null);
      setErrors({});
      fetchStudents();

      setTimeout(() => setSuccessMessage(''), 3000);
    } catch (err) {
      if (err.response && err.response.status === 422) {
        setErrors(err.response.data.errors);
      } else {
        console.error('Unexpected error:', err);
      }
    }
  };

  return (
    <form onSubmit={handleSubmit}>
      <h1>Student Manager</h1>
      {successMessage && (
        <p style={{ textAlign: 'center', color: 'green', marginBottom: '10px' }}>
          {successMessage}
        </p>
      )}

      <input
        name="name"
        value={form.name}
        onChange={handleChange}
        placeholder="Name"
        required
      />
      {errors.name && <p className="error">{errors.name[0]}</p>}

      <input
        name="email"
        value={form.email}
        onChange={handleChange}
        placeholder="Email"
        required
      />
      {errors.email && <p className="error">{errors.email[0]}</p>}

      <input
        name="age"
        value={form.age}
        onChange={handleChange}
        placeholder="Age"
        type="number"
        required
      />
      {errors.age && <p className="error">{errors.age[0]}</p>}

      <input
        name="major"
        value={form.major}
        onChange={handleChange}
        placeholder="Major"
        required
      />
      {errors.major && <p className="error">{errors.major[0]}</p>}

      <button type="submit">{editingStudent ? 'Update' : 'Add'} Student</button>
    </form>
  );
}