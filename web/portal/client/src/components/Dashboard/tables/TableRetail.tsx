import _ from '@irontec/ivoz-ui/services/translations/translate';
import {
  Paper,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
} from '@mui/material';

import { DashboardData } from '../@types';
import { StyledTable } from './styles/Table.styles';
import { StyledTableCell } from './styles/TableCell.styles';
import { StyledTableHeadRow, StyledTableRow } from './styles/TableRow.styles';

export const TableRetail = ({
  latestRetailAccounts,
}: DashboardData): JSX.Element => {
  return (
    <>
      <div className='header'>
        <div className='title'>{_('Last added Retail Accounts')}</div>
      </div>
      <div className='table'>
        <TableContainer component={Paper} sx={{ boxShadow: 'none' }}>
          <StyledTable>
            <TableHead>
              <StyledTableHeadRow>
                <StyledTableCell>{_('Name')}</StyledTableCell>
                <StyledTableCell>{_('Description')}</StyledTableCell>
                <StyledTableCell>{_('Outgoing DDI')}</StyledTableCell>
              </StyledTableHeadRow>
            </TableHead>
            <TableBody>
              {latestRetailAccounts?.map((row, key) => (
                <StyledTableRow key={key}>
                  <TableCell component='th' scope='row'>
                    {row.name}
                  </TableCell>
                  <TableCell>{row.description}</TableCell>
                  <TableCell>{row.outgoingDdi}</TableCell>
                </StyledTableRow>
              ))}
            </TableBody>
          </StyledTable>
        </TableContainer>
      </div>
    </>
  );
};
