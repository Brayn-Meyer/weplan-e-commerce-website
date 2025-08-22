import React, { useState } from 'react';
import { Calendar } from 'lucide-react';
interface AdventureBookingProps {
  onDataUpdate: (data: any) => void;
  bookingData: any;
}
const AdventureBooking: React.FC<AdventureBookingProps> = ({ onDataUpdate, bookingData }) => {
  const [selectedAdventures, setSelectedAdventures] = useState<string[]>([]);
  const [adventureSchedule, setAdventureSchedule] = useState<{[key: string]: string}>({});
  const adventures = [
    { id: 'cycling', name: 'Cycling', icon: ':man-biking:' },
    { id: 'hiking', name: 'Hiking', icon: ':hiking_boot:' },
    { id: 'diving', name: 'Scuba Diving', icon: ':diving_mask:' },
    { id: 'surfing', name: 'Surfing', icon: ':man-surfing:' },
    { id: 'kayaking', name: 'Kayaking', icon: ':canoe:' },
    { id: 'climbing', name: 'Rock Climbing', icon: ':man_climbing:' },
    { id: 'safari', name: 'Safari', icon: ':lion_face:' },
    { id: 'skydiving', name: 'Skydiving', icon: ':parachute:' },
    { id: 'bungee', name: 'Bungee Jumping', icon: ':man-cartwheeling:' },
    { id: 'cooking', name: 'Cooking Class', icon: ':male-cook:' },
    { id: 'photography', name: 'Photography Tour', icon: ':camera_with_flash:' },
    { id: 'wine', name: 'Wine Tasting', icon: ':wine_glass:' },
    { id: 'spa', name: 'Spa Day', icon: ':woman_in_lotus_position:' },
    { id: 'boat', name: 'Boat Trip', icon: ':boat:' }
  ];
  const handleAdventureToggle = (adventureId: string) => {
    let newSelected;
    if (selectedAdventures.includes(adventureId)) {
      newSelected = selectedAdventures.filter(id => id !== adventureId);
      const newSchedule = { ...adventureSchedule };
      delete newSchedule[adventureId];
      setAdventureSchedule(newSchedule);
    } else {
      newSelected = [...selectedAdventures, adventureId];
    }
    setSelectedAdventures(newSelected);
    updateBookingData(newSelected, adventureSchedule);
  };
  const handleScheduleChange = (adventureId: string, date: string) => {
    const newSchedule = { ...adventureSchedule, [adventureId]: date };
    setAdventureSchedule(newSchedule);
    updateBookingData(selectedAdventures, newSchedule);
  };
  const updateBookingData = (adventures: string[], schedule: {[key: string]: string}) => {
    onDataUpdate({
      adventures: {
        selected: adventures,
        schedule: schedule
      }
    });
  };
  const getAvailableDates = () => {
    if (!bookingData.flight?.startDate || !bookingData.flight?.endDate) return [];
    const start = new Date(bookingData.flight.startDate);
    const end = new Date(bookingData.flight.endDate);
    const dates = [];
    // Start from the day after arrival
    const current = new Date(start);
    current.setDate(current.getDate() + 1);
    // End the day before departure
    while (current < end) {
      dates.push(current.toISOString().split('T')[0]);
      current.setDate(current.getDate() + 1);
    }
    return dates;
  };
  const availableDates = getAvailableDates();
  return (
    <div className="space-y-6">
      {/* Adventure Selection */}
      <div>
        <label className="block text-sm font-medium text-gray-700 mb-3">
          Select Your Adventures
        </label>
        <div className="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-3">
          {adventures.map((adventure) => (
            <div
              key={adventure.id}
              onClick={() => handleAdventureToggle(adventure.id)}
              className={`p-3 rounded-xl border-2 cursor-pointer transition-all duration-300 text-center hover:scale-105 ${
                selectedAdventures.includes(adventure.id)
                  ? 'border-pink-500 bg-pink-50 shadow-lg transform scale-105'
                  : 'border-gray-200 hover:border-pink-300 hover:shadow-md'
              }`}
            >
              <div className="text-2xl mb-2">{adventure.icon}</div>
              <span className="text-sm font-medium text-gray-900">{adventure.name}</span>
            </div>
          ))}
        </div>
      </div>
      {/* Schedule Selected Adventures */}
      {selectedAdventures.length > 0 && (
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-3">
            <Calendar className="w-4 h-4 inline mr-2" />
            Schedule Your Adventures
          </label>
          <div className="space-y-4">
            {selectedAdventures.map((adventureId) => {
              const adventure = adventures.find(a => a.id === adventureId);
              return (
                <div key={adventureId} className="flex items-center justify-between p-4 bg-pink-50 rounded-2xl">
                  <div className="flex items-center space-x-3">
                    <span className="text-xl">{adventure?.icon}</span>
                    <span className="font-medium text-gray-900">{adventure?.name}</span>
                  </div>
                  <select
                    value={adventureSchedule[adventureId] || ''}
                    onChange={(e) => handleScheduleChange(adventureId, e.target.value)}
                    className="p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                  >
                    <option value="">Select date</option>
                    {availableDates.map((date) => (
                      <option key={date} value={date}>
                        {new Date(date).toLocaleDateString('en-US', {
                          weekday: 'short',
                          month: 'short',
                          day: 'numeric'
                        })}
                      </option>
                    ))}
                  </select>
                </div>
              );
            })}
          </div>
        </div>
      )}
      {availableDates.length === 0 && (
        <div className="p-4 bg-yellow-50 border border-yellow-200 rounded-2xl">
          <p className="text-yellow-800">
            Please complete your flight booking first to see available dates for adventures.
          </p>
        </div>
      )}
    </div>
  );
};
export default AdventureBooking;