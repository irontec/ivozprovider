import { CustomActionsType } from '@irontec/ivoz-ui/entities/EntityInterface';

import AddHolidayDateRange from './AddHolidayDateRange';

const customAction: CustomActionsType = {
  AddHolidayDateRange: {
    action: AddHolidayDateRange,
    global: true,
  },
};

export default customAction;
