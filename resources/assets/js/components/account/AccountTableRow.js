const AccountTableRow = ({account}) => (
    <tr>
      <td>{account.id}</td>
      <td>{account.currency}</td>
      <td>{account.balance}</td>
      <td>{account.available}</td>
      <td>{account.hold}</td>
    </tr>
);

export default AccountTableRow
