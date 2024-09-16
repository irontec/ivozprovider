import { ScalarProperty } from '@irontec/ivoz-ui';
import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';
import { useStoreState } from 'store';

import { ClientFeatures, ClientTypes } from '../Company/ClientFeatures';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { NotificationTemplateProperties } from './NotificationTemplateProperties';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, properties } = props;

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  const features = aboutMe?.features;
  const vpbxInFeatures = features?.includes(ClientTypes.vpbx);
  const residentialInFeatures = features?.includes(ClientTypes.residential);
  const billingInFeatures = features?.includes(ClientFeatures.billing);
  const invoicesInFeatures = features?.includes(ClientFeatures.invoices);

  const updatedProperties = properties as NotificationTemplateProperties;

  if (!vpbxInFeatures && !residentialInFeatures) {
    delete (updatedProperties.type as ScalarProperty).enum?.fax;
    delete (updatedProperties.type as ScalarProperty).enum?.voicemail;
  }

  if (!billingInFeatures) {
    delete (updatedProperties.type as ScalarProperty).enum?.lowbalance;
    delete (updatedProperties.type as ScalarProperty).enum?.maxDailyUsage;
  }

  if (!invoicesInFeatures) {
    delete (updatedProperties.type as ScalarProperty).enum?.invoice;
  }

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['name', 'type'],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
