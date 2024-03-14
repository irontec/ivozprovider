import { OutlinedButton } from '@irontec/ivoz-ui/components/shared/Button/Button.styles';
import useCurrentPathMatch from '@irontec/ivoz-ui/hooks/useCurrentPathMatch';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { PlayCircleOutline } from '@mui/icons-material';
import ErrorIcon from '@mui/icons-material/Error';
import {
  Box,
  CircularProgress,
  Dialog,
  DialogActions,
  DialogContent,
  DialogTitle,
} from '@mui/material';
import { ChangeEvent, useState } from 'react';
import { useStoreActions } from 'store';

import TerminalModel from '../../TerminalModel';
import StyledTemplateAction from '../TemplateAction.styles';
import { PropsType } from './SpecificTemplate';

const RunTemplate = (props: PropsType): JSX.Element => {
  const { formik } = props;

  const apiGet = useStoreActions((store) => store.api.get);
  const match = useCurrentPathMatch();

  const [open, setOpen] = useState(false);
  const [mac, setMac] = useState('');
  const [errorMsg, setErrorMsg] = useState('');
  const [running, setRunning] = useState(false);
  const [result, setResult] = useState('');

  const handleOpen = () => setOpen(true);
  const handleClose = () => {
    setOpen(false);
    setErrorMsg('');
    setResult('');
  };

  const onChange = (event: ChangeEvent<{ value: string }>) => {
    setMac(event.target.value);
  };

  const handleExec = () => {
    setRunning(true);
    setErrorMsg('');

    apiGet({
      path: `${TerminalModel.path}/${match.params.id}/test_specific_template?mac=${mac}`,
      params: {},
      handleErrors: false,
      successCallback: async (response) => {
        setResult(response as unknown as string);
      },
    })
      .catch((error: { data: { detail?: string; title: string } }) => {
        setErrorMsg(error.data.detail || error.data.title);
      })
      .finally(() => {
        setRunning(false);
      });
  };

  return (
    <>
      <StyledTemplateAction onClick={handleOpen}>
        <PlayCircleOutline /> {_('Test template')}
      </StyledTemplateAction>
      {open && (
        <Dialog open={open} onClose={handleClose} keepMounted>
          <DialogTitle>{_('Test template')}</DialogTitle>
          <DialogContent sx={{ textAlign: 'left!important' }}>
            {!errorMsg && (
              <Box
                sx={{
                  display: 'flex',
                  alignItems: 'center',
                  justifyContent: 'center',
                }}
              >
                {running && <CircularProgress />}
                {!result && !running && (
                  <span>
                    {_('This template is going to be tested')}
                    <br />
                    <textarea
                      style={{
                        width: '500px',
                        height: '250px',
                      }}
                      defaultValue={formik?.initialValues.genericTemplate}
                      readOnly={true}
                    />
                    <br />
                    MAC: <input type='text' name='mac' onChange={onChange} />
                  </span>
                )}
                {result && (
                  <span>
                    <textarea
                      style={{
                        width: '500px',
                        height: '250px',
                      }}
                      defaultValue={result}
                      readOnly={true}
                    />
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
            {!result && (
              <OutlinedButton disabled={!mac} onClick={handleExec}>
                {_('Exec')}
              </OutlinedButton>
            )}
            {!result && (
              <OutlinedButton onClick={handleClose}>
                {_('Cancel')}
              </OutlinedButton>
            )}
            {result && (
              <OutlinedButton onClick={handleClose}>
                {_('Close')}
              </OutlinedButton>
            )}
          </DialogActions>
        </Dialog>
      )}
    </>
  );
};

export default RunTemplate;
