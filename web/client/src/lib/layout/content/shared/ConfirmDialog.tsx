import React, { forwardRef, ComponentType } from 'react';
import Button from '@mui/material/Button';
import Dialog from '@mui/material/Dialog';
import DialogActions from '@mui/material/DialogActions';
import DialogContent from '@mui/material/DialogContent';
import DialogContentText from '@mui/material/DialogContentText';
import DialogTitle from '@mui/material/DialogTitle';
import Slide, { SlideProps } from '@mui/material/Slide';

const Transition: ComponentType<any> = forwardRef(
  function (
    props: SlideProps,
    ref: React.Ref<unknown>,
  ) {
    return <Slide {...props} direction="up" ref={ref} />;
  }
);
Transition.displayName = 'ConfirmDialogTransition';

interface ConfirmDialogProps {
  text: string,
  open: boolean,
  handleClose: (event: unknown) => void,
  handleApply: (event: unknown) => void
}

export default function ConfirmDialog(props: ConfirmDialogProps): JSX.Element {

  const { text, open, handleClose, handleApply } = props;

  return (
    <Dialog
      open={open}
      TransitionComponent={Transition}
      keepMounted
      onClose={handleClose}
      aria-labelledby="alert-dialog-slide-title"
      aria-describedby="alert-dialog-slide-description"
    >
      <DialogTitle id="alert-dialog-slide-title">Remove element</DialogTitle>
      <DialogContent>
        <DialogContentText id="alert-dialog-slide-description">
          {text}
        </DialogContentText>
      </DialogContent>
      <DialogActions>
        <Button onClick={handleClose}>
          Cancel
        </Button>
        <Button onClick={handleApply}>
          Delete
        </Button>
      </DialogActions>
    </Dialog>
  );

}
