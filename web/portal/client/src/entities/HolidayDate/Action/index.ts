import { CustomActionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';

import AddHolidayDateRange from './AddHolidayDateRange';
import Import from './Import';

const customAction: CustomActionsType = {
  AddHolidayDateRange: {
    action: AddHolidayDateRange,
    global: true,
  },
  Import: {
    action: Import,
    global: true,
  },
};

export default customAction;
