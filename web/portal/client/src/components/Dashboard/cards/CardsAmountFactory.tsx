import { useStoreState } from 'store';

import { CardFactoryProps } from '../@types';
import { CardsAmountResidential } from './CardsAmountResidential';
import { CardsAmountRetail } from './CardsAmountRetail';
import { CardsAmountVpbx } from './CardsAmountVpbx';
import { CardsAmountWholesale } from './CardsAmountWholeSale';

export const CardsAmountFactory = (
  props: CardFactoryProps
): JSX.Element | null => {
  const { activeCalls, data } = props;
  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  if (!aboutMe) {
    return null;
  }

  if (aboutMe?.wholesale) {
    return <CardsAmountWholesale activeCalls={activeCalls} />;
  }

  if (aboutMe?.residential) {
    return (
      <CardsAmountResidential
        voiceMailNum={data?.voiceMailNum}
        residentialDeviceNum={data?.residentialDeviceNum}
        ddiNum={data?.ddiNum}
      />
    );
  }

  if (aboutMe?.retail) {
    return (
      <CardsAmountRetail
        ddiNum={data?.ddiNum}
        activeCallsNum={activeCalls?.total}
        retailsAccountNum={data?.retailsAccountNum}
      />
    );
  }

  if (aboutMe?.vpbx) {
    return (
      <CardsAmountVpbx
        userNum={data?.userNum}
        ddiNum={data?.ddiNum}
        extensionNum={data?.extensionNum}
      />
    );
  }

  throw Error('Unknown Client type');
};
