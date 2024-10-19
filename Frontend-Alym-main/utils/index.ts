import { DateTime } from 'luxon';

export function getRelativeTimeFromISO(dateString: string) {
    return DateTime.fromISO(dateString).toRelative();
}
