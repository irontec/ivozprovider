import { OutlinedButton } from '@irontec/ivoz-ui/components/shared/Button/Button.styles';
import useCurrentPathMatch from '@irontec/ivoz-ui/hooks/useCurrentPathMatch';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ErrorIcon from '@mui/icons-material/Error';
import RestorePageIcon from '@mui/icons-material/RestorePage';
import {
  Box,
  CircularProgress,
  Dialog,
  DialogActions,
  DialogContent,
  DialogTitle,
} from '@mui/material';
import { useState } from 'react';
import { useStoreActions } from 'store';

import TerminalModel from '../../TerminalModel';
import StyledTemplateAction from '../TemplateAction.styles';
import { PropsType } from './SpecificTemplate';

const Restore = (props: PropsType): JSX.Element => {
  const { formik } = props;

  const apiGet = useStoreActions((store) => store.api.get);
  const match = useCurrentPathMatch();

  const [open, setOpen] = useState(false);
  const [errorMsg, setErrorMsg] = useState('');
  const [restoring, setRestoring] = useState(false);

  const handleOpen = () => setOpen(true);
  const handleClose = () => {
    setOpen(false);
    setErrorMsg('');
  };

  const handleRestore = () => {
    setRestoring(true);
    setErrorMsg('');

    apiGet({
      path: `${TerminalModel.path}/${match.params.id}/default_template?type=specific`,
      params: {},
      handleErrors: false,
      successCallback: async (response) => {
        formik?.setFieldValue('specificTemplate', response);
        handleClose();
      },
    })
      .catch((error: { data: { detail?: string; title: string } }) => {
        setErrorMsg(error.data.detail || error.data.title);
      })
      .finally(() => {
        setRestoring(false);
      });
  };

  return (
    <>
      <StyledTemplateAction onClick={handleOpen}>
        <RestorePageIcon /> {_('Restore default template')}
      </StyledTemplateAction>
      {open && (
        <Dialog open={open} onClose={handleClose} keepMounted>
          <DialogTitle>{_('Restore default template')}</DialogTitle>
          <DialogContent sx={{ textAlign: 'left!important' }}>
            {!errorMsg && (
              <Box
                sx={{
                  display: 'flex',
                  alignItems: 'center',
                  justifyContent: 'center',
                }}
              >
                {restoring && <CircularProgress />}
                {!restoring && (
                  <span>
                    {_('Restore default template?')}
                    <br />
                    (templates/provisioning/YealinkT21P_E2/specific.cfg)
                  </span>
                )}
              </Box>
            )}
            {errorMsg && (
              <span>
                <ErrorIcon
                  sx={{
                    verticalAlign: 'bottom',
                  }}
                />
                {errorMsg ?? 'There was a problem'}
              </span>
            )}
          </DialogContent>
          <DialogActions>
            <OutlinedButton onClick={handleRestore}>
              {_('Restore')}
            </OutlinedButton>
            <OutlinedButton onClick={handleClose}>{_('Cancel')}</OutlinedButton>
          </DialogActions>
        </Dialog>
      )}
    </>
  );
};

export default Restore;
