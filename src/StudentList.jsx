import axios from './axios';
import './styles/Studentlist.css';
import { useState } from 'react';

export default function StudentList({ students, fetchStudents, setEditingStudent, pagination }) {
  const [searchTerm, setSearchTerm] = useState('');
  const [successMessage, setSuccessMessage] = useState(''); 

  const handleSearch = async () => {
    fetchStudents('name', 'asc', searchTerm);
  };

  const handleReset = () => {
    setSearchTerm('');
    fetchStudents();
  }

  const handleDelete = async (id) => {
    if (window.confirm('Are you sure you want to delete this student?')) {
      try {
        await axios.delete(`/students/${id}`);
        fetchStudents();
        setSuccessMessage('Student deleted successfully!');
        setTimeout(() => setSuccessMessage(''), 3000); 
      } catch (err) {
        console.error('Error deleting student:', err);
        alert('Failed to delete student. Please try again.');
      }
    }
  };

  const handlePageChange = (page) => {
    if (page > 0 && page <= pagination.last_page) {
      fetchStudents('name', 'asc', '', page);
    }
  };

  return (
    <div className="student-list-container">
      <h2>Students List</h2>
      {successMessage && (
        <p> {successMessage} </p>
      )}
      <div className="nav-search">
        <input
          type="text"
          placeholder="Search students..."
          value={searchTerm}
          onChange={(e) => setSearchTerm(e.target.value)}
          onKeyDown={(e) => e.key === 'Enter' && handleSearch()}
          
        />
        <button onClick={handleSearch}>Search</button>
        <button onClick={handleReset}>Reset</button>

        <div className='sort-by'>
          <select onChange={(e) => fetchStudents(e.target.value, 'asc')}>
            <option value="name">Name</option>
            <option value="email">Email</option>
            <option value="age">Age</option>
          </select>
        </div>
      </div>

      <table className="student-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Major</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          {Array.isArray(students) && students.length > 0 ? (
            students.map((student) => (
              <tr key={student.id}>
                <td>{student.name}</td>
                <td>{student.email}</td>
                <td>{student.age}</td>
                <td>{student.major}</td>
                <td>
                  <div className="action-buttons">
                    <button
                      className="btn btn-edit"
                      onClick={() => setEditingStudent(student)}
                    >
                      Edit
                    </button>
                    <button
                      className="btn btn-delete"
                      onClick={() => handleDelete(student.id)}
                    >
                      Delete
                    </button>
                  </div>
                </td>
              </tr>
            ))
          ) : (
            <tr>
              <td colSpan="5" style={{ textAlign: 'center' }}>
                No students found.
              </td>
            </tr>
          )}
        </tbody>
      </table>
      <div className="pagination">
          <button
            onClick={() => handlePageChange(pagination.current_page - 1)}
            disabled={pagination.current_page === 1}
          >
            &laquo; 
          </button>
          {Array.from({ length: pagination.last_page }, (_, index) => (
            <button
              key={index + 1}
              onClick={() => handlePageChange(index + 1)}
              className={pagination.current_page === index + 1 ? 'active' : ''}
            >
              {index + 1}
            </button>
          ))}
          <button
            onClick={() => handlePageChange(pagination.current_page + 1)}
            disabled={pagination.current_page === pagination.last_page}
          >
            &raquo; 
          </button>
      </div>
    </div>
  );
}