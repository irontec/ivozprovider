import { Theme, Card, CardContent } from '@mui/material';
import { styled } from '@mui/styles';

export const StyledCard = styled(Card)(
  ({ theme }: { theme: Theme }) => {
    return {
      width: '100%',
      margin: '10px',
      textAlign: 'center',
    }
  }
);

export const StyledCardContent = styled(CardContent)(
  ({ theme }: { theme: Theme }) => {
    return {
      padding: '16px 5px',
    }
  }
);