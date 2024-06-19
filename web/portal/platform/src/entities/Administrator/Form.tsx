import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';
import _ from '@irontec/ivoz-ui/services/translations/translate';

import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;
  const edit = props.edit || false;

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Login Info'),
      fields: ['username', 'pass', edit && 'active', 'timezone', 'restricted'],
    },
    {
      legend: _('Personal data'),
      fields: ['name', 'lastname', 'email'],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
