import { styled } from '@mui/styles';

import Header from './Header';

export const StyledHeader = styled(Header)(() => {
  return {
    display: 'flex',
    justifyContent: 'space-between',
    alignItems: 'center',
    '& .end, & .start': {
      display: 'flex',
      gap: 'var(--spacing-md)',
      alignItems: 'center',
    },
    '& .MuiBreadcrumbs-li:last-child': {
      color: 'var(--color-title)',
      '& p , & a': {
        fontWeight: 'bold',
      },
    },
    '& .back-mobile': {
      display: 'flex',
      alignItems: 'center',
      color: 'var(--color-title)',
      fontWeight: 'bold',
    },
  };
});
