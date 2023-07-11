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

export const TableVpbx = ({ latestUsers }: DashboardData): JSX.Element => {
  return (
    <>
      <div className='header'>
        <div className='title'>{_('Last added users')}</div>
      </div>
      <div className='table'>
        <TableContainer component={Paper} sx={{ boxShadow: 'none' }}>
          <StyledTable>
            <TableHead>
              <StyledTableHeadRow>
                <StyledTableCell>{_('Name')}</StyledTableCell>
                <StyledTableCell>{_('Last Name')}</StyledTableCell>
                <StyledTableCell>
                  {_('Extension', { count: 1 })}
                </StyledTableCell>
                <StyledTableCell>{_('Outgoing DDI')}</StyledTableCell>
              </StyledTableHeadRow>
            </TableHead>
            <TableBody>
              {latestUsers?.map((row, key) => (
                <StyledTableRow key={key}>
                  <TableCell component='th' scope='row'>
                    {row.name}
                  </TableCell>
                  <TableCell>{row.lastName}</TableCell>
                  <TableCell>{row.extension}</TableCell>
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
