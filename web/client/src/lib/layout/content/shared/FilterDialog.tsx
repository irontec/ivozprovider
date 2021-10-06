import React from 'react';
import {
  Button, Dialog, Toolbar, IconButton, Slide
} from '@mui/material';
import CloseIcon from '@mui/icons-material/Close';
import { TransitionProps } from '@mui/material/transitions/transition';
import _ from 'lib/services/translations/translate';
import { StyledAppBar, StyledFilterDialogTypography } from './FilterDialog.styles';

const Transition = React.forwardRef<unknown, TransitionProps>((props: any, ref) => {
  return <Slide direction="up" ref={ref} {...props} />;
});
Transition.displayName = 'FilterDialogTransition';

export default function FullScreenDialog(props: any) {

  const { open, handleClose, apply } = props;

  return (
    <div>
      <Dialog fullScreen open={open} onClose={handleClose} TransitionComponent={Transition}>
        <StyledAppBar>
          <Toolbar>
            <IconButton edge="start" color="inherit" onClick={handleClose} aria-label="close">
              <CloseIcon />
            </IconButton>
            <StyledFilterDialogTypography>
              {_('Search')}
            </StyledFilterDialogTypography>
            <Button autoFocus color="inherit" onClick={apply}>
              {_('Apply')}
            </Button>
          </Toolbar>
        </StyledAppBar>
        {props.children}
      </Dialog>
    </div>
  );
}
