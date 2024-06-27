import { Badge, styled, Theme } from '@mui/material';

import { DdiProviderRegistrationStatus } from '../DdiProviderRegistrationProperties';

export const StyledBadge = styled(Badge)(
  ({
    theme,
    status = undefined,
  }: {
    theme?: Theme;
    status: DdiProviderRegistrationStatus | undefined;
  }) => {
    let color = '#FF0000';

    if (status?.registered) {
      color = '#44b700';
    } else if (status?.inProgress) {
      color = '#FFCC00';
    }

    return {
      marginLeft: 25,
      '& .MuiBadge-badge': {
        backgroundColor: color,
        color: color,
        height: '16px',
        width: '16px',
        borderRadius: '50%',
        boxShadow: `0 0 0 2px ${theme?.palette.background.paper}`,
        '&::after': {
          position: 'absolute',
          top: 0,
          left: 0,
          width: '100%',
          height: '100%',
          borderRadius: '50%',
          animation: 'ripple 1.2s infinite ease-in-out',
          border: '1px solid currentColor',
          content: '""',
        },
      },
      '@keyframes ripple': {
        '0%': {
          transform: 'scale(.8)',
          opacity: 1,
        },
        '100%': {
          transform: 'scale(2.4)',
          opacity: 0,
        },
      },
    };
  }
);
