import _ from 'lib/services/translations/translate';
import { Tooltip } from '@mui/material';
import { StyledStatusIconArrowForwardIcon, StyledStatusIconRotateLeftIcon } from './StatusIcon.styles';

interface StatusIconProps {
    directConnectivity: string,
    _context: string,
}

const StatusIcon = (props: StatusIconProps): JSX.Element => {

    const { directConnectivity, _context } = props;
    const writeContext = (_context === 'write');

    if (directConnectivity === 'yes') {

        if (writeContext) {
            return (
                <span>
                    <StyledStatusIconArrowForwardIcon />
                    {_('Direct connectivity')}
                </span>
            );
        }

        return (
            <Tooltip title={_('Direct connectivity')}>
                <StyledStatusIconArrowForwardIcon />
            </Tooltip>
        );
    }

    if (directConnectivity === 'intervpbx') {

        if (writeContext) {
            return (
                <span>
                    <StyledStatusIconRotateLeftIcon />
                    {_('Inter company connectivity')}
                </span>
            );
        }

        return (
            <Tooltip title={_('Inter company connectivity')}>
                <StyledStatusIconRotateLeftIcon />
            </Tooltip>
        );
    }

    //@TODO POSPONED else RegisterStatus::getLocationStatus
    return (<span />);
}

export default StatusIcon;