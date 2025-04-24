import { useEffect, useState } from 'react';
import axios from './axios';
import StudentForm from './StudentForm';
import StudentList from './StudentList';

function App() {
  const [students, setStudents] = useState([]);
  const [editingStudent, setEditingStudent] = useState(null);
  const [searchTerm, setSearchTerm] = useState('');
  const [pagination, setPagination] = useState({});

  const fetchStudents = async (sortBy = 'name', order = 'asc', search = '', page = 1) => {
    try {
      const response = await axios.get('/students', {
        params: { sort_by: sortBy, order: order, search: search, page: page }
      });
      console.log('API Response:', response.data); 
      const data = response.data.data || [];
      setStudents(Array.isArray(data) ? data : []);
      setPagination({
        current_page: response.data.current_page,
        last_page: response.data.last_page,
        per_page: response.data.per_page,
        total: response.data.total,
        links: response.data.links,
      }); 
    } catch (err) {
      console.error('Error fetching students:', err);
    }
  };

  const handleSearch = async () => {
    fetchStudents('name', 'asc', searchTerm); 
  };


  useEffect(() => {
    fetchStudents();
  }, []);

  return (
    <div className="App">
    <StudentForm
      fetchStudents={fetchStudents}
      editingStudent={editingStudent}
      setEditingStudent={setEditingStudent}
    />
    <StudentList
      students={students}
      fetchStudents={fetchStudents}
      setEditingStudent={setEditingStudent}
      pagination={pagination}
    />
  </div>
  );
}

export default App;
