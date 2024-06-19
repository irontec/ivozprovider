import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { Link } from 'react-router-dom';
import store from 'store';

import { HolidayDatePropertyList } from '../HolidayDateProperties';

type HolidayDateValues = HolidayDatePropertyList<string | number>;
type TargetGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<HolidayDateValues>
>;

const Type: TargetGhostType = (props): JSX.Element => {
  const { values } = props;

  if (values && values.calendar) {
    const entities = store.getState().entities.entities;
    const Calendar = entities.Calendar;
    const calendarVal = values.calendar as Record<string, string>;

    const calendarLink = `${Calendar.path}/${calendarVal.id}/update`;
    const calendarStr = Calendar?.toStr(calendarVal);

    return (
      <Link to={calendarLink} style={{ color: 'inherit' }}>
        {calendarStr}
      </Link>
    );
  }

  return <span></span>;
};

export default withCustomComponentWrapper<HolidayDateValues>(Type);
