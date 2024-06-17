import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
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

export const TableWholeSale = ({
  latestBillableCalls,
}: DashboardData): JSX.Element => {
  return (
    <>
      <div className='header'>
        <div className='title'>{_('Last Calls')}</div>
      </div>
      <div className='table'>
        <TableContainer component={Paper} sx={{ boxShadow: 'none' }}>
          <StyledTable>
            <TableHead>
              <StyledTableHeadRow>
                <StyledTableCell>{_('Date')}</StyledTableCell>
                <StyledTableCell>{_('Caller')}</StyledTableCell>
                <StyledTableCell>{_('Callee')}</StyledTableCell>
                <StyledTableCell>{_('Duration')}</StyledTableCell>
              </StyledTableHeadRow>
            </TableHead>
            <TableBody>
              {latestBillableCalls?.map((row, key) => (
                <StyledTableRow key={key}>
                  <TableCell component='th' scope='row'>
                    {row.startTime}
                  </TableCell>
                  <TableCell>{row.caller}</TableCell>
                  <TableCell>{row.callee}</TableCell>
                  <TableCell>{row.duration}</TableCell>
                </StyledTableRow>
              ))}
            </TableBody>
          </StyledTable>
        </TableContainer>
      </div>
    </>
  );
};
