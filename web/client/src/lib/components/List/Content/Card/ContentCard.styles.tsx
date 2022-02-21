import { Card, CardActions } from '@mui/material';
import { styled } from '@mui/styles';

export const StyledCardActions = styled(CardActions)(
  () => {
    return {
      'padding': '0 16px',
      'display': 'flex',
      'justifyContent': 'space-between',
    };
  }
);

export const StyledCardContainer = styled('div')(
  () => {
    return {};
  }
);

export const StyledCard = styled(Card)(
  () => {
    return {
      'margin': '0 0 10px',
      'padding': '0 0 20px',
      'boxShadow': 'none',
      'borderBottom': '1px solid #ccc',
      'borderRadius': 'unset',
    };
  }
);
