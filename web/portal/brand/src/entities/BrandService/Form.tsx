import { PropertyList } from '@irontec/ivoz-ui';
import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';

import useFkChoices from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, match, properties } = props;
  const edit = props.edit || false;

  const service = props.row?.service as Record<string, number> | undefined;
  const currentServiceId = service?.id;

  const fkChoices = useFkChoices({
    entityService,
    match,
    currentServiceId,
  });

  if (edit) {
    const newProperties = { ...properties };
    newProperties.service = {
      ...newProperties.service,
      readOnly: true,
    };

    entityService.replaceProperties(newProperties as PropertyList);
  }

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['service'],
    },
    {
      legend: '',
      fields: ['code'],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
