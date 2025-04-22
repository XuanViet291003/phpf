import { useState, useEffect } from 'react';
import axios from './axios';
import './styles/Student.css'

export default function StudentForm({ fetchStudents, editingStudent, setEditingStudent }) {
  const [form, setForm] = useState({
    name: '',
    email: '',
    age: '',
    major: ''
  });

  useEffect(() => {
    if (editingStudent) {
      setForm(editingStudent);
    }
  }, [editingStudent]);

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (editingStudent) {
      await axios.put(`/students/${editingStudent.id}`, form);
    } else {
      await axios.post('/students', form);
    }
    setForm({ name: '', email: '', age: '', major: '' });
    setEditingStudent(null);
    fetchStudents();
  }; 

  return (
    <form onSubmit={handleSubmit}>
      <input name="name" value={form.name} onChange={handleChange} placeholder="Name" required />
      <input name="email" value={form.email} onChange={handleChange} placeholder="Email" required />
      <input name="age" value={form.age} onChange={handleChange} placeholder="Age" type="number" required />
      <input name="major" value={form.major} onChange={handleChange} placeholder="Major" required />
      <button type="submit">{editingStudent ? 'Update' : 'Add'} Student</button>
    </form>
  );
}
