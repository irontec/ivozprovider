
import { styled } from '@mui/styles';
import { Theme } from '@mui/material';
import Dropdown from './Dropdown';

const StyledDropdown = styled(
  Dropdown
)(
  ({ theme }: { theme: Theme }) => {
    return {
      '& > label.changed': {
        color: theme.palette.info.main
      }
    }
  }
);


export default StyledDropdown;