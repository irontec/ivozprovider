import { TableRow } from '@mui/material';
import { styled } from '@mui/styles';

export const StyledTableRow = styled(TableRow)(() => {
  return {
    '&:last-child td, &:last-child th': { border: 0 },
  };
});

export const StyledTableHeadRow = styled(TableRow)(() => {
  return {
    fontSize: '13px',
  };
});
