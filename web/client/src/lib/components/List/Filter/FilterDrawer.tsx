import Drawer from '@mui/material/Drawer';
import { StyledFilterBoxContent } from './FilterBoxContent.styles';
import { FilterDialogContentProps } from './FilterBoxContent';

type FilterBoxProps = FilterDialogContentProps & {
  open: boolean,
}

export default function FilterDrawer(props: FilterBoxProps): JSX.Element {

  const { open, handleClose, apply, children } = props;

  return (
    <Drawer
      anchor={'right'}
      open={open}
      onClose={handleClose}
    >
      <StyledFilterBoxContent handleClose={handleClose} apply={apply}>
        {children}
      </StyledFilterBoxContent>
    </Drawer >
  );
}
