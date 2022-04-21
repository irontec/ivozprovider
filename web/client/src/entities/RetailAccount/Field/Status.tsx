import { styled } from '@mui/styles';
import { Tooltip } from '@mui/material';
import DoneIcon from '@mui/icons-material/Done';
import PhoneAndroidIcon from '@mui/icons-material/PhoneAndroid';
import CloseIcon from '@mui/icons-material/Close';
import EastIcon from '@mui/icons-material/East';
import RestartAltIcon from '@mui/icons-material/RestartAlt';
import PublicIcon from '@mui/icons-material/Public';
import LightbulbIcon from '@mui/icons-material/Lightbulb';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { RetailAccountPropertyList, RetailAccountStatus } from '../RetailAccountProperties';

type ScalarRowTypes = RetailAccountPropertyList<string | boolean>;
type StatusValues = ScalarRowTypes & { status: Array<RetailAccountStatus> };
type StatusIconProps = PropertyCustomFunctionComponent<PropertyCustomFunctionComponentProps<ScalarRowTypes, StatusValues>>;

const Status: StatusIconProps = (props): JSX.Element | null => {

  const { _context, values } = props;

  if (_context !== 'write' || !values) {
    return null;
  }

  const iconStyles = { 'verticalAlign': 'bottom' };
  const iconStyler = () => iconStyles;

  if (values.directConnectivity === 'yes') {

    const StyledIcon = styled(EastIcon)(iconStyler);
    return (<span><StyledIcon /> Direct connectivity</span>);
  }

  if (values.directConnectivity === 'intervpbx') {
    const StyledIcon = styled(RestartAltIcon)(iconStyler);
    return (<span><StyledIcon /> Inter company connectivity</span>);
  }

  if (!values.status || !Array.isArray(values.status) || values.status.length === 0) {
    const StyledIcon = styled(CloseIcon)(iconStyler);
    return (<span><StyledIcon /> Not registered</span>);
  }

  const StyledDoneIcon = styled(DoneIcon)(iconStyler);
  const StyledPhoneAndroidIcon = styled(PhoneAndroidIcon)(iconStyler);
  const StyledPublicIcon = styled(PublicIcon)(iconStyler);
  const StyledLightbulbIcon = styled(LightbulbIcon)(iconStyler);

  return (
    <>
    {values.status.map((row, key) => {

      const received = row.received.match(/sips?:([^@]+@)?([^;]+)/)?.pop();
      const publicReceived = row.publicReceived;
      const expires = row.expires;
      const userAgent = row.userAgent;
      const contact = row.contact.match(/sips?:([^@]+@)?(.+)/)?.pop();
      const publicContact = row.publicContact;

      let hintMsg: string | React.ReactElement = '';
      if (!received) {

        hintMsg = publicContact
          ? _('No NAT with public Contact (hint: SIP ALG / STUN)')
          : _('No NAT with private Contact (hint: internal routing)');

      } else if (contact === received) {

        hintMsg = _('Regular NAT detected');

      } else if (publicReceived && !publicContact) {

        hintMsg = _('Regular NAT detected');

      } else {

        const contactVisibility = publicContact
          ? _('Public')
          : _('Private');

        const receivedVisibility = publicReceived
          ? _('Public')
          : _('Private');

        hintMsg = _(
          'Awkward NAT detected (<0 /> Contact, <1 /> Received)',
          {},
          [
            contactVisibility,
            receivedVisibility,
          ],
        );
      }

      return (
        <div key={key}>
            <div>
              <Tooltip title={_('Registered until: {{date}}', { date: expires })}>
                <StyledDoneIcon />
              </Tooltip>
              {userAgent}
            </div>
            <div>
              <Tooltip title={_('Contact Address')}>
                <StyledPhoneAndroidIcon />
              </Tooltip>
              {contact}
            </div>
            <div>
              <Tooltip title={_('Received Address')}>
                <StyledPublicIcon />
              </Tooltip>
              {received}
            </div>
            <div>
              <Tooltip title={_('Hint')}>
                <StyledLightbulbIcon/ >
              </Tooltip>
              {hintMsg}
            </div>
        </div>
      );
    })}
    </>
  );
};

export default Status;