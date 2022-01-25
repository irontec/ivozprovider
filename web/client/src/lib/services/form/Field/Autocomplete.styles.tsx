
import { styled } from '@mui/styles';
import { Theme } from '@mui/material';
import Autocomplete from './Autocomplete';

const StyledAutocomplete = styled(
  Autocomplete
)(
  ({ theme }: { theme: Theme }) => {
    return {
      '&.changed label': {
        color: theme.palette.info.main
      }
    }
  }
);


export default StyledAutocomplete;