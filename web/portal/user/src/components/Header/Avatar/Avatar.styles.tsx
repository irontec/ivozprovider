import { styled } from '@mui/styles';

import Avatar from './Avatar';

export const StyledAvatar = styled(Avatar)(() => {
  const size = '46px';

  return {
    backgroundColor: 'var(--color-title)',
    color: 'white',
    fontSize: 'var(--font-size-secondary-title)',
    borderRadius: '50%',
    fontWeight: 'bold',
    display: 'grid',
    placeItems: 'center',
    width: `${size}`,
    height: `${size}`,

    '& .account': {
      cursor: 'pointer',
    },
  };
});
