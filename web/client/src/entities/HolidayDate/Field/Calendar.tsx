import withCustomComponentWrapper, {
    PropertyCustomFunctionComponent,
    PropertyCustomFunctionComponentProps
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { HolidayDatePropertyList } from '../HolidayDateProperties';
import entities from '../../index';
import { Link } from 'react-router-dom';

type HuntGroupsRelUserValues = HolidayDatePropertyList<
    string | number
>;
type TargetGhostType = PropertyCustomFunctionComponent<PropertyCustomFunctionComponentProps<HuntGroupsRelUserValues>>;

const Type: TargetGhostType = (props): JSX.Element => {

    const { values } = props;

    if (values && values.calendar) {

        const Calendar = entities?.Calendar;
        const calendarVal = values.calendar as Record<string, string>;

        const calendarLink = `${Calendar.path}/${calendarVal.id}/update`;
        const calendarStr = Calendar?.toStr(calendarVal);

        return (
            <Link to={calendarLink} style={{ color: 'inherit' }}>{calendarStr}</Link>
        );
    }

    return (<span></span>);
}

export default withCustomComponentWrapper<HuntGroupsRelUserValues>(Type);