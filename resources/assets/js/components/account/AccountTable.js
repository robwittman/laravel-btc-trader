import { AccountTableRow } from './AccountTableRow';
import React from 'react';
import { Table } from 'react-bootstrap';

const AccountTable = ({accounts}) => (
    <Table striped bordered hover>
      <thead>
        <tr>
          <th>ID</th>
          <th>Currency</th>
          <th>Balance</th>
          <th>Available</th>
          <th>Hold</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </Table>
);

export default AccountTable;
