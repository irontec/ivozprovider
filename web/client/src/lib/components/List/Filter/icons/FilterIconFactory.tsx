import Contains from './contains';
import StartsWith from './startsWith';
import EndsWith from './endsWith';
import Equals from './equals';
import NotEquals from './notEquals';
import LowerThan from './lowerThan';
import LowerThanEqual from './lowerThanEqual';
import GreaterThan from './greaterThan';
import GreaterThanEqual from './greaterThanEqual';
import AssignmentTurnedInIcon from '@mui/icons-material/AssignmentTurnedIn';
import _ from 'lib/services/translations/translate';
import { styled } from '@mui/styles';
import { OverridableComponent } from '@mui/material/OverridableComponent';
import { SvgIconTypeMap } from '@mui/material';

export type SearchFilterType = '' | 'exists' | 'partial' | 'start' | 'end' | 'in' | 'exact' | 'eq' | 'neq' | 'lt' | 'lte' | 'gt' | 'gte';

interface FilterIconFactoryProps {
    name: SearchFilterType,
    className?: string,
    fontSize?: 'small' | 'inherit' | 'large' | 'medium' | undefined,
    includeLabel?: boolean
}

export default function FilterIconFactory(props: FilterIconFactoryProps): JSX.Element {

    const { name, includeLabel, ...rest } = props;

    const icon = getFilterIcon(name);
    const StyledIcon = styled(icon as any)(
        () => {
            return {
                verticalAlign: 'bottom',
                paddingRight: '7px'
            }
        }
    );

    if (!includeLabel) {
        return (<StyledIcon {...rest} />);
    }

    return (
        <span>
            <StyledIcon {...rest} />
            {getFilterLabel(name)}
        </span>
    );
}

export const getFilterIcon = (name: string): OverridableComponent<SvgIconTypeMap> => {

    switch (name) {
        case 'exists':
            return AssignmentTurnedInIcon;
        case 'partial':
            return Contains;
        case 'start':
            return StartsWith;
        case 'end':
            return EndsWith;
        case '':
        case 'in':
            return Equals;
        case 'exact':
        case 'eq':
            return Equals;
        case 'neq':
            return NotEquals;
        case 'lt':
            return LowerThan;
        case 'lte':
            return LowerThanEqual;
        case 'gt':
            return GreaterThan;
        case 'gte':
            return GreaterThanEqual;
        default:
            const error = { error: `Icon ${name} was not found` };
            throw error;
    }
}

export const getFilterLabel = (value: string): JSX.Element => {

    const filterTypes: { [key: string]: JSX.Element } = {
        "": _("Equals"),
        "in": _("Equals"),
        "eq": _("Equals"),
        "exact": _("Equals"),
        "neq": _("Does not Equal"),
        "start": _("Starts with"),
        "partial": _("Contains"),
        "end": _("Ends with"),
        "gt": _("Is greater than"),
        "gte": _("Is greater than equal"),
        "lt": _("Is lower than"),
        "lte": _("Is lower than equal"),
        "exists": _("Exists"),
    };

    return filterTypes[value];
}
