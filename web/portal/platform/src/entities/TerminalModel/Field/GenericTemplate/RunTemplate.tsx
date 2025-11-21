import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import useCurrentPathMatch from '@irontec/ivoz-ui/hooks/useCurrentPathMatch';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { PlayCircleOutline } from '@mui/icons-material';
import ErrorIcon from '@mui/icons-material/Error';
import { CircularProgress } from '@mui/material';
import { useState } from 'react';
import { useStoreActions } from 'store';

import TerminalModel from '../../TerminalModel';
import {
  StyledErrorContainer,
  StyledTemplateAction,
  StyledTextArea,
  StyledTextAreaContainer,
} from '../TemplateAction.styles';
import { PropsType } from './GenericTemplate';

const RunTemplate = (props: PropsType): JSX.Element => {
  const { formik } = props;

  const apiGet = useStoreActions((store) => store.api.get);
  const match = useCurrentPathMatch();

  const [open, setOpen] = useState(false);
  const [errorMsg, setErrorMsg] = useState('');
  const [running, setRunning] = useState(false);
  const [result, setResult] = useState('');

  const handleOpen = () => setOpen(true);
  const handleClose = () => {
    setOpen(false);
    setErrorMsg('');
    setResult('');
  };

  const handleExec = () => {
    setRunning(true);
    setErrorMsg('');

    apiGet({
      path: `${TerminalModel.path}/${match.params.id}/test_generic_template`,
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

  const customButtons = [
    {
      label: result ? _('Close') : _('Cancel'),
      onClick: handleClose,
      variant: 'outlined',
      autoFocus: false,
    },
    {
      label: _('Exec'),
      onClick: handleExec,
      variant: 'solid',
      autoFocus: true,
      disabled: errorMsg,
    },
  ];

  return (
    <>
      <StyledTemplateAction onClick={handleOpen}>
        <PlayCircleOutline /> {_('Test template')}
      </StyledTemplateAction>
      {open && (
        <Modal
          open={open}
          onClose={handleClose}
          title={_('Test template')}
          buttons={customButtons}
          keepMounted={true}
        >
          {!errorMsg && (
            <>
              {running && <CircularProgress />}
              {!running && (
                <>
                  <span>{_('This template is going to be tested')}</span>
                  <StyledTextAreaContainer>
                    <StyledTextArea
                      defaultValue={
                        result ? result : formik?.initialValues.specificTemplate
                      }
                      readOnly={true}
                    />
                  </StyledTextAreaContainer>
                </>
              )}
            </>
          )}
          {errorMsg && (
            <StyledErrorContainer>
              <ErrorIcon />
              {errorMsg ?? 'There was a problem'}
            </StyledErrorContainer>
          )}
        </Modal>
      )}
    </>
  );
};

export default RunTemplate;
